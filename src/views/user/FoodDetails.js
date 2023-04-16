import Navigation from "../../components/Navigation";
import Error from "../../components/Error";
import { useParams, useNavigate } from "react-router-dom";
import { useState, useEffect } from "react";
import supabase from "../../config/supabaseClient";
import Title from "../../components/Title";
import toTitle from "../../utils/format";
import { Button, Container, Form } from "react-bootstrap";

const FoodDetails = () => {
    const navigate = useNavigate();
    const { id } = useParams();

    const [error, setError] = useState(null);
    const [user, setUser] = useState(null);
    const [categories, setCategories] = useState([]);
    const [foodId, setFoodId] = useState(null);
    const [name, setName] = useState('');
    const [quantity, setQuantity] = useState(1);
    const [details, setDetails] = useState('');
    const [category, setCategory] = useState(1);
    const [formError, setFormError] = useState(null);

    useEffect(() => {

        (async () => {
            const { data: { user } } = await supabase.auth.getUser();

            const { data, error } = await supabase
                .from('foods')
                .select('id, name, quantity, details, cid')
                .match({ uid: user.id, id: id })
                .limit(1)
                .single();

            const resp = await supabase
                .from('categories')
                .select('id, name')
                .order('id');

            setUser(user);

            if (error || resp.error) {
                setError('Erreur durant la récupération des données');
            } else {
                setCategories(resp.data);
                setFoodId(data.id);
                setName(data.name);
                setQuantity(data.quantity);
                setDetails(data.details);
                setCategory(data.cid);
            }
        })();
    }, []);

    const handleSubmit = async (e) => {
        e.preventDefault();

        if (name === '' || !quantity || parseInt(quantity) < 1 || !category) {
            return setFormError('Le formulaire est incomplet');
        }
        const { error } = await supabase
            .from('foods')
            .update({ name: toTitle(name), quantity: parseInt(quantity), details: details, cid: category, uid: user.id })
            .match({ id: foodId });

        error ? setFormError('Erreur durant la modification') : navigate(-1);
    }

    const handleDelete = async () => {

        if (window.confirm('Supprimer ?')) {
            const { error } = await supabase
                .from('foods')
                .delete()
                .match({ id: foodId });

            error ? setFormError('Erreur durant la suppression') : navigate(-1);
        }
    }

    return (
        <Container>
            <Navigation url={'/foods'} />

            {error && <Error message={error} />}

            {!error && <>

                <Title title={name} />

                <Form onSubmit={handleSubmit}>
                    <Form.Group className="mb-2" controlId="name">
                        <Form.Label>Nom</Form.Label>
                        <Form.Control type="text" placeholder="Nom" value={name} onChange={e => setName(e.target.value)} required />
                    </Form.Group>

                    <Form.Group className="mb-2" controlId="quantity">
                        <Form.Label>Quantité</Form.Label>
                        <Form.Control type="number" step="1" min="1" value={quantity} onChange={e => setQuantity(e.target.value)} required />
                    </Form.Group>

                    <Form.Group className="mb-2" controlId="details">
                        <Form.Label>Détails</Form.Label>
                        <Form.Control type="textarea" rows="4" value={details} onChange={e => setDetails(e.target.value)} />
                    </Form.Group>

                    <Form.Group className="mb-2" controlId="category">
                        <Form.Label>Catégories</Form.Label>
                        <Form.Select aria-label="Catégories" value={category} onChange={e => setCategory(e.target.value)}>
                            {categories.map(c => <option key={c.id} value={c.id}>{c.name}</option>)}
                        </Form.Select>
                    </Form.Group>

                    <Button className="btn btn-primary my-2" type="submit">Enregistrer</Button>

                    {formError && <Error message={formError} />}
                </Form>

                <Button className="btn btn-danger my-2" onClick={handleDelete}>Supprimer</Button>
            </>}
        </Container>
    );
}

export default FoodDetails;