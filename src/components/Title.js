const Title = (props) => {
    return (
        <div className="text-center">
            { props.img && <img src={props.img} alt="Logo" width="100" height="100" /> }
            <h1 className="h4 mb-3 fw-normal mt-2">{props.title}</h1>
        </div>
    );
}

export default Title;