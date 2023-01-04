import FoodTile from "../../components/FoodTile";
import Nav from "../../components/Nav";
import Title from "../../components/Title";
import Error from "../../components/Error";
import { useState, useEffect } from "react";
import supabase from "../../config/supabaseClient";

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
        <>
            <Nav />

            <Title title='Aliments' />

            {error && <Error message={error} />}

            {!error && <table className="table table-striped">
                <tbody>
                    <tr>
                        <th>Nom</th>
                        <th>Quantité</th>
                    </tr>
                    {foods.map(f => <FoodTile key={f.id} id={f.id} name={f.name} quantity={f.quantity} />)}
                </tbody>
            </table>}
        </>
    );
}

export default Foods;
