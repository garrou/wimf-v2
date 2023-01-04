const CategoryTile = (props) => {
    return (
        <tr>
            <td>
                <a href={`/categories/${props.id}`}>
                    <img src={props.image} className="img-fluid my-2" width="50" height="50" alt="Logo de la catégorie" />
                </a>
            </td>
            <td class="align-middle">
                <a href={`/categories/${props.id}`}>{props.name}</a>
            </td>
        </tr>
    );
}

export default CategoryTile;