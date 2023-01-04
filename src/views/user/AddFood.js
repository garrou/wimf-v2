import Nav from "../../components/Nav";
import Title from "../../components/Title";
import Error from "../../components/Error";
import { useState, useEffect } from "react";
import { useNavigate } from "react-router-dom";
import supabase from "../../config/supabaseClient";

const AddFood = () => {
    const [user, setUser] = useState(null);
    const [categories, setCategories] = useState([]);

    const [name, setName] = useState('');
    const [quantity, setQuantity] = useState(1);
    const [details, setDetails] = useState('');
    const [category, setCategory] = useState(1);

    const [formError, setFormError] = useState(null);
    const navigate = useNavigate();

    useEffect(() => {
        (async () => {
            const { data: { user } } = await supabase.auth.getUser();
            setUser(user);

            const { data } = await supabase.from('categories')
                .select('id, name')
                .order('id');

            setCategories(data);
        })();
    });

    const handleSubmit = async (e) => {
        e.preventDefault();

        if (name === '' || !quantity) {
            return setFormError('Le formulaire est incomplet');
        }
        const { error } = await supabase
            .from('foods')
            .insert({ name: name, quantity: quantity, details: details, cid: category, uid: user.id });

        if (error) {
            setFormError("Erreur durant l'ajout");
        } else {
            navigate('/foods');
        }
    }

    return (
        <>
            <Nav />

            <Title title="Ajouter un aliment" />

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

                <select className="form-select" aria-label="Catégories" onChange={e => setCategory(e.target.value)}>
                    {categories.map(c => <option key={c.id} value={c.id}>{c.name}</option>)}
                </select>

                <button className="btn btn-primary my-2" type="submit">Ajouter</button>

                {formError && <Error message={formError} />}
            </form>
        </>
    );
}

export default AddFood;