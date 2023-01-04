const CategoryTile = (props) => {
    return (
        <tr>
            <td>
                <a href={`/categories/${props.id}`}>
                    <img src={props.image} className="img-fluid my-2" width="100" height="100" alt="Logo de la catégorie" />
                </a>
            </td>
            <td>
                <a href={`/categories/${props.id}`}>{props.name}</a>
            </td>
        </tr>
    );
}

export default CategoryTile;