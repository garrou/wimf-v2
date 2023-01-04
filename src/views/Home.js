import GoogleButton from "../components/GoogleButton";
import supabase from "../config/supabaseClient";
import { useNavigate } from "react-router-dom";

const Home = () => {
    const navigate = useNavigate();

    supabase.auth.onAuthStateChange(async (event, session) => {
        console.log(event, session)
        if (event !== "SIGNED_OUT") {
            navigate('/account');
        } else {
            navigate('/');
        }
    });

    return (
        <>
            <div className="px-5 py-5 my-5 text-center">
                <img className="d-block mx-auto mb-4" src="logo.png" alt="" width="100" height="100" />
                <h1 className="display-5 fw-bold">W I M F</h1>
                <div className="col-lg-6 mx-auto">
                    <p className="lead mb-4">WIMF, une application pour gérer son congélateur.</p>
                    <div className="d-grid gap-2 d-sm-flex justify-content-sm-center">
                        <GoogleButton />
                    </div>
                </div>
            </div>
        </>
    );
}

export default Home;
