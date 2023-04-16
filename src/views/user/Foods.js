import FoodTile from "../../components/FoodTile";
import Navigation from "../../components/Navigation";
import Title from "../../components/Title";
import Error from "../../components/Error";
import { useState, useEffect } from "react";
import supabase from "../../config/supabaseClient";
import { Container, Table } from "react-bootstrap";

const Foods = () => {
    const [error, setError] = useState(null);
    const [foods, setFoods] = useState([]);

    useEffect(() => {
        (async () => {
            const { data: { user } } = await supabase.auth.getUser();

            const { data, error } = await supabase
                .from('foods')
                .select('id, name, quantity, details')
                .match({ uid: user.id });

            if (error) {
                setError('Erreur durant la récupération des données');
            } else {
                setFoods(data);
            }
        })();
    }, []);

    return (
        <Container>
            <Navigation url={'/foods'} />

            <Title title='Aliments' />

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

export default Foods;
