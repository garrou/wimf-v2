import { useEffect } from "react";
import { useNavigate } from "react-router-dom";
import supabase from "../config/supabaseClient";

const Redirect = () => {
    const navigate = useNavigate();

    useEffect(() => {
        (async () => {
            const { data } = await supabase.auth.getSession();

            if (data && data.session) {
                navigate('/categories', { replace: true });
            } else {
                navigate('/', { replace: true });
            }
        })();
    }, []);
}

export default Redirect;