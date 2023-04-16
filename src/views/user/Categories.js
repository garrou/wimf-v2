import { useEffect, useState } from "react";
import CategoryTile from "../../components/CategoryTile";
import Error from "../../components/Error";
import Navigation from "../../components/Navigation";
import Title from "../../components/Title";
import supabase from "../../config/supabaseClient";
import { Container, Table } from "react-bootstrap";

const Categories = () => {
    const [error, setError] = useState(null);
    const [categories, setCategories] = useState([]);

    useEffect(() => {
        (async () => {
            const { data, error } = await supabase
                .from('categories')
                .select('id, name, image')
                .order('id');

            error ? setError('Erreur durant la récupération des données') : setCategories(data);
        })();
    }, []);

    return (
        <Container>
            <Navigation url={'/categories'} />

            <Title title='Catégories' />

            {error && <Error message={error} />}

            {!error && <Table striped>
                <tbody>
                    {categories.map(c => <CategoryTile key={c.id} id={c.id} name={c.name} image={c.image} />)}
                </tbody>
            </Table>}
        </Container>
    );
}

export default Categories;
