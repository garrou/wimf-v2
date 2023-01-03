import { Navigate } from "react-router-dom";
import supabase from "../config/supabaseClient";

const PrivateRoute = ({ children }) => {
    const isLoggedIn = supabase.auth.getUser();
    return isLoggedIn ? children : <Navigate to="/login" replace={true} />
}

export default PrivateRoute;