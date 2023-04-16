import { Container } from "react-bootstrap";

const NotFound = () => {
    return (
        <Container className="text-center mt-4">
            <h1>Page introuvable</h1>
            <a className="text-decoration-none" href="/">Retour à l'accueil</a>
        </Container>
    );
}

export default NotFound;
