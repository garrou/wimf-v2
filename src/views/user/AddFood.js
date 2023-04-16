import Navigation from "../../components/Navigation";
import Title from "../../components/Title";
import Error from "../../components/Error";
import { useState, useEffect } from "react";
import { useNavigate } from "react-router-dom";
import supabase from "../../config/supabaseClient";
import toTitle from "../../utils/format";
import { Button, Container, Form } from "react-bootstrap";

const AddFood = () => {
    const [user, setUser] = useState(null);
    const [categories, setCategories] = useState([]);
    const [formError, setFormError] = useState(null);
    const navigate = useNavigate();

    useEffect(() => {
        (async () => {
            const { data: { user } } = await supabase.auth.getUser();
            
            const { data } = await supabase
                .from('categories')
                .select('id, name')
                .order('id');

            setUser(user);
            setCategories(data);
        })();
    }, []);

    const handleSubmit = async (e) => {
        e.preventDefault();

        const name = e.target.name.value;
        const quantity = e.target.quantity.value;
        const details = e.target.details.value;
        const category = e.target.category.value;

        if (name === '' || !quantity || parseInt(quantity) < 1 || !category) {
            return setFormError('Le formulaire est incomplet');
        }
        const { error } = await supabase
            .from('foods')
            .insert({ name: toTitle(name), quantity: parseInt(quantity), details: details, cid: category, uid: user.id });

        error ? setFormError("Erreur durant l'enregistrement") : navigate('/foods');
    }

    return (
        <Container>
            <Navigation url={'/foods/add'} />

            <Title title="Ajouter un aliment" />

            <Form onSubmit={handleSubmit}>
                <Form.Group className="mb-2" controlId="name">
                    <Form.Label>Nom</Form.Label>
                    <Form.Control type="text" placeholder="Nom" required />
                </Form.Group>

                <Form.Group className="mb-2" controlId="quantity">
                    <Form.Label>Quantité</Form.Label>
                    <Form.Control type="number" step="1" min="1" required />
                </Form.Group>

                <Form.Group className="mb-2" controlId="details">
                    <Form.Label>Détails</Form.Label>
                    <Form.Control type="textarea" rows="4" />
                </Form.Group>

                <Form.Group className="mb-2" controlId="category">
                    <Form.Label>Catégories</Form.Label>
                    <Form.Select aria-label="Catégories">
                        {categories.map(c => <option key={c.id} value={c.id}>{c.name}</option>)}
                    </Form.Select>
                </Form.Group>

                <Button className="btn btn-primary my-2" type="submit">Ajouter</Button>

                {formError && <Error message={formError} />}
            </Form>
        </Container>
    );
}

export default AddFood;