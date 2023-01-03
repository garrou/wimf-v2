import { useEffect, useState } from "react";
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
        </>
    );
}

export default Categories;
