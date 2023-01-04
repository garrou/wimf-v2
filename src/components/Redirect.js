import { useEffect } from 'react';
import { Navigate } from "react-router-dom";
import supabase from "../config/supabaseClient";

const Redirect = ({ children }) => {
    useEffect(() => {
        (async () => {
            const { data: { user } } = await supabase.auth.getUser();
            return !user ? children : <Navigate to="/categories" replace={true} />
        })();
    }, []);
}

export default Redirect;