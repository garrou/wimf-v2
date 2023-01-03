import { BrowserRouter, Routes, Route } from "react-router-dom";
import PrivateRoute from "./components/PrivateRoute";
import Redirect from "./components/Redirect";
import Home from "./views/Home";
import Categories from "./views/user/Categories";
import Foods from "./views/user/Foods";

function App() {
  return (
    <div className="App">
      <BrowserRouter>
        <Routes>
          <Route path="/" element={<Redirect><Home /></Redirect>} />

          <Route path="/categories" element={<PrivateRoute><Categories /></PrivateRoute>} />
          <Route path="/foods" element={<PrivateRoute><Foods /></PrivateRoute>} />
        </Routes>
      </BrowserRouter>
    </div>
  );
}

export default App;
