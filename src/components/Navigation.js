import { useNavigate } from "react-router-dom";
import supabase from "../config/supabaseClient";
import Guard from "./Guard";
import { Button, Container, Nav, Navbar } from "react-bootstrap";

const Navigation = ({ url }) => {
    const navigate = useNavigate();

    const handleClick = async () => {
        await supabase.auth.signOut();
        navigate('/', { replace: true });
    }

    return (
        <>
            <Guard />

            <Navbar bg="light" expand="lg">
                <Container>
                    <Navbar.Brand href="/series">Anothapp</Navbar.Brand>
                    <Navbar.Toggle aria-controls="basic-navbar-nav" />
                    <Navbar.Collapse id="basic-navbar-nav">
                        <Nav defaultActiveKey={url} className="me-auto">
                            <Nav.Link href="/categories">Catégories</Nav.Link>
                            <Nav.Link href="/foods">Aliments</Nav.Link>
                            <Nav.Link href="/foods/add">Ajouter</Nav.Link>
                            <Button variant="outline-dark" className="btn-sm" onClick={handleClick}>Se déconnecter</Button>
                        </Nav>
                    </Navbar.Collapse>
                </Container>
            </Navbar>
        </>
    );
}

export default Navigation;