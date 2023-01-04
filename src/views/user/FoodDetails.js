import Nav from "../../components/Nav";
import Error from "../../components/Error";
import { useParams, useNavigate } from "react-router-dom";
import { useState, useEffect } from "react";
import supabase from "../../config/supabaseClient";
import Title from "../../components/Title";

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
            setUser(user);

            const { data, error } = await supabase.from('foods')
                .select('id, name, quantity, details')
                .match({ uid: user.id, id: id })
                .limit(1)
                .single();

            const resp = await supabase.from('categories')
                .select('id, name')
                .order('id');
            setCategories(resp.data);

            if (error || resp.error) {
                setError('Erreur durant la récupération des informations');
            } else {
                setFoodId(data.id);
                setName(data.name);
                setQuantity(data.quantity);
                setDetails(data.details);
                setCategory(data.category);
            }
        })();
    }, []);

    const handleSubmit = async (e) => {
        e.preventDefault();

        const { error } = await supabase
            .from('foods')
            .update({ name: name, quantity: quantity, details: details, cid: category, uid: user.id })
            .match({ id: foodId });

        if (error) {
            setFormError('Erreur durant la modification');
        } else {
            navigate(-1);
        }
    }

    return (
        <>
            <Nav />

            {error && <Error message={error} />}

            <Title title={name} />

            <form onSubmit={handleSubmit}>
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

                <select className="form-select" aria-label="Catégories" onChange={e => setCategory(e.target.value)} value={category}>
                    {categories.map(c => <option key={c.id} value={c.id}>{c.name}</option>)}
                </select>

                <button className="btn btn-primary my-2" type="submit">Ajouter</button>

                {formError && <Error message={formError} />}
            </form>
        </>
    );
}

export default FoodDetails;