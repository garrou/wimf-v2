import { Navigate } from "react-router-dom";
import supabase from "../config/supabaseClient";

const Redirect = ({ children }) => {
    const isLoggedIn = supabase.auth.getUser();
    return !isLoggedIn ? children : <Navigate to="/categories" replace={true} />
}

export default Redirect;