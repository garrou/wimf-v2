import Nav from "../../components/Nav";
import Error from "../../components/Error";
import { useParams, useNavigate } from "react-router-dom";
import { useState, useEffect } from "react";
import supabase from "../../config/supabaseClient";
import Title from "../../components/Title";
import toTitle from "../../utils/format";

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
            setCategories(resp.data);

            if (error || resp.error) {
                setError('Erreur durant la récupération des données');
            } else {
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

        if (name === '' || !quantity || parseInt(quantity) < 1) {
            return setFormError('Le formulaire est incomplet');
        }
        const { error } = await supabase
            .from('foods')
            .update({ name: toTitle(name), quantity: parseInt(quantity), details: details, cid: category, uid: user.id })
            .match({ id: foodId });

        if (error) {
            setFormError('Erreur durant la modification');
        } else {
            navigate(-1);
        }
    }

    const handleDelete = async () => {

        if (window.confirm('Supprimer ?')) {
            const { error } = await supabase
                .from('foods')
                .delete()
                .match({ id: foodId });

            if (error) {
                setFormError('Erreur durant la suppression');
            } else {
                navigate(-1);
            }
        }
    }

    return (
        <>
            <Nav />

            {error && <Error message={error} />}

            <Title title={name} />

            {!error && <form onSubmit={handleSubmit}>
                <div className="form-floating mb-2">
                    <input type="text" value={name} className="form-control" onChange={e => setName(e.target.value)} required />
                    <label htmlFor="floatingInput">Nom</label>
                </div>

                <div className="form-floating mb-2">
                    <input type="number" step="1" min="1" value={quantity} className="form-control" onChange={e => setQuantity(e.target.value)} required />
                    <label htmlFor="floatingInput">Quantité</label>
                </div>

                <div className="form-floating mb-2">
                    <textarea value={details} className="form-control" onChange={e => setDetails(e.target.value)} rows="4" />
                    <label htmlFor="floatingInput">Détails</label>
                </div>

                <select className="form-select" aria-label="Catégories" value={category} onChange={e => setCategory(e.target.value)}>
                    {categories.map(c => <option key={c.id} value={c.id}>{c.name}</option>)}
                </select>

                <button className="btn btn-primary my-2" type="submit">Enregistrer</button>

                {formError && <Error message={formError} />}
            </form>}

            <button className="btn btn-danger my-2" onClick={handleDelete}>Supprimer</button>
        </>
    );
}

export default FoodDetails;