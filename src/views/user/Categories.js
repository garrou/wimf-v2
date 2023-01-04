import { useEffect, useState } from "react";
import CategoryTile from "../../components/CategoryTile";
import Error from "../../components/Error";
import Nav from "../../components/Nav";
import Title from "../../components/Title";
import supabase from "../../config/supabaseClient";

const Categories = () => {
    const [error, setError] = useState(null);
    const [categories, setCategories] = useState([]);

    useEffect(() => {

        (async () => {
            const { data, error } = await supabase.from('categories')
                .select('id, name, image')
                .order('id');

            if (error) {
                setError('Erreur durant la récupération des catégories');
            } else {
                setCategories(data);
            }
        })();
    }, []);

    return (
        <>
            <Nav />
            <Title title='Catégories' />

            {error && <Error message={error} />}

            <table className="table table-bordered">
                <tbody>
                    {categories.map(c => <CategoryTile key={c.id} id={c.id} name={c.name} image={c.image} />)}
                </tbody>
            </table>
        </>
    );
}

export default Categories;
