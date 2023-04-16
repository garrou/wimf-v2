import { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import Error from "../../components/Error";
import FoodTile from "../../components/FoodTile";
import Navigation from "../../components/Navigation";
import Title from "../../components/Title";
import supabase from "../../config/supabaseClient";
import { Container, Table } from "react-bootstrap";

const CategoryFood = () => {
    const [error, setError] = useState(null);
    const [foods, setFoods] = useState([]);
    const [category, setCategory] = useState(null);
    const { id } = useParams();

    useEffect(() => {

        (async () => {
            const { data: { user } } = await supabase.auth.getUser();
            const { data, error } = await supabase
                .from('foods')
                .select('id, name, quantity, details')
                .match({ cid: id, uid: user.id })
                .order('id');

            const resp = await supabase
                .from('categories')
                .select('name')
                .match({ id: id })
                .limit(1)
                .single();

            if (error || resp.error) {
                setError('Erreur durant la récupération des données');
            } else {
                setFoods(data);
                setCategory(resp.data.name);
            }
        })();
    }, []);

    return (
        <Container>
            <Navigation url={'/foods'} />
            <Title title={category} />

            {error && <Error message={error} />}

            {!error && <Table striped>
                <tbody>
                    <tr>
                        <th>Nom</th>
                        <th>Quantité</th>
                    </tr>
                    {foods.map(f => <FoodTile key={f.id} id={f.id} name={f.name} quantity={f.quantity} />)}
                </tbody>
            </Table>}
        </Container>
    );
}

export default CategoryFood;
