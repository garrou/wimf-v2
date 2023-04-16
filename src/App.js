import 'bootstrap/dist/css/bootstrap.min.css';
import { BrowserRouter, Routes, Route } from "react-router-dom";
import Home from "./views/Home";
import Categories from "./views/user/Categories";
import CategoryFood from "./views/user/CategoryFoods";
import FoodDetails from "./views/user/FoodDetails";
import Foods from "./views/user/Foods";
import AddFood from "./views/user/AddFood";
import NotFound from "./views/NotFound";

function App() {
  return (
    <div className="App">
      <BrowserRouter>
        <Routes>
          <Route path="/" element={<Home />} />

          <Route path="/categories" element={<Categories />} />
          <Route path="/categories/:id" element={<CategoryFood />} />
          <Route path="/foods" element={<Foods />} />
          <Route path="/foods/:id" element={<FoodDetails />} />
          <Route path="/foods/add" element={<AddFood />} />

          <Route path="*" element={<NotFound />} />
        </Routes>
      </BrowserRouter>
    </div>
  );
}

export default App;
