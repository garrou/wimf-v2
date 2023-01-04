import Nav from "../../components/Nav";
import Title from "../../components/Title";
import { useParams } from "react-router-dom";

const FoodDetails = () => {
    const { id } = useParams();

    return (
        <>
            <Nav />
            <Title title="Détails" />
        </>
    );
}

export default FoodDetails;