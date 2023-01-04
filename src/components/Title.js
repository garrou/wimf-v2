const Title = (props) => {
    return (
        <div className="text-center">
            {props.img && <img src={props.img} alt="Logo" width="100" height="100" />}
            <h1 className="my-2 fw-normal">{props.title}</h1>
        </div>
    );
}

export default Title;