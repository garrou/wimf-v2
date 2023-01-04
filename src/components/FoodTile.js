const FoodTile = (props) => {
    return (
        <tr>
            <td>
                <a className="text-decoration-none" href={`/foods/${props.id}`}>{props.name}</a>
            </td>
            <td>{props.quantity}</td>
        </tr>
    );
}

export default FoodTile;