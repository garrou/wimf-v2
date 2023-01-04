import { useEffect } from "react";
import { useNavigate } from "react-router-dom";
import supabase from "../config/supabaseClient";

const Guard = () => {
    const navigate = useNavigate();

    useEffect(() => {
        (async () => {
            const { data } = await supabase.auth.getSession();

            if (data && !data.session) {
                navigate('/', { replace: true });
            }
        })();
    }, []);
}

export default Guard;