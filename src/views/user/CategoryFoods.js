import { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import Error from "../../components/Error";
import FoodTile from "../../components/FoodTile";
import Nav from "../../components/Nav";
import Title from "../../components/Title";
import supabase from "../../config/supabaseClient";

const CategoryFood = () => {
    const [error, setError] = useState(null);
    const [foods, setFoods] = useState([]);
    const { id } = useParams();

    useEffect(() => {

        (async () => {
            const { data: { user } } = await supabase.auth.getUser();

            console.log(user);

            const { data, error } = await supabase.from('foods')
                .select('id, name, quantity, details')
                .match({ cid: id, uid: user.id })
                .order('id');

            if (error) {
                setError('Erreur durant la récupération des aliments');
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

            <table className="table table-striped">
                {foods.map(f => <FoodTile key={f.id} id={f.id} name={f.name} quantity={f.quantity} />)}
            </table>
        </>
    );
}

export default CategoryFood;
