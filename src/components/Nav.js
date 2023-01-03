import { Link, useNavigate } from "react-router-dom";
import supabase from "../config/supabaseClient";

const Nav = () => {
    const navigate = useNavigate();

    const handleClick = async () => {
        await supabase.auth.signOut();
        navigate('/');
    }

    return (
        <nav className="navbar navbar-expand-lg bg-light">
            <div className="container-fluid">
                <a className="navbar-brand" href="/categories">W I M F</a>
                <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span className="navbar-toggler-icon"></span>
                </button>
                <div className="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul className="navbar-nav">
                        <li className="nav-item">
                            <Link className="nav-link" to="/categories">Catégories</Link>
                        </li>
                        <li className="nav-item">
                            <Link className="nav-link" to="/foods">Aliments</Link>
                        </li>
                        <li className="nav-item">
                            <Link className="nav-link" onClick={handleClick}>Se déconnecter</Link>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    );
}

export default Nav;