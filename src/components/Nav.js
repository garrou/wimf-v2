import { Link, useNavigate } from "react-router-dom";
import supabase from "../config/supabaseClient";
import Guard from "./Guard";

const Nav = () => {
    const navigate = useNavigate();

    const handleClick = async () => {
        await supabase.auth.signOut();
        navigate('/', { replace: true });
    }

    return (
        <>
            <Guard />

            <nav className="navbar navbar-expand-lg bg-light">
                <a className="navbar-brand mx-2" href="/categories">W I M F</a>
                <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span className="navbar-toggler-icon"></span>
                </button>
                <div className="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul className="navbar-nav mr-auto">
                        <li className="nav-item">
                            <Link className="nav-link" to="/categories">Catégories</Link>
                        </li>
                        <li className="nav-item">
                            <Link className="nav-link" to="/foods">Aliments</Link>
                        </li>
                        <li className="nav-item">
                            <Link className="nav-link" to="/foods/add">Ajouter</Link>
                        </li>
                        <li>
                            <button className="btn btn-outline-primary" onClick={handleClick}>Se déconnecter</button>
                        </li>
                    </ul>
                </div>
            </nav>
        </>
    );
}

export default Nav;