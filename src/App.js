import { BrowserRouter, Routes, Route } from "react-router-dom";
import Home from "./views/Home";
import Account from "./views/user/Account";
import Categories from "./views/user/Categories";
import CategoryFood from "./views/user/CategoryFoods";
import FoodDetails from "./views/user/FoodDetails";
import Foods from "./views/user/Foods";

function App() {
  return (
    <div className="App">
      <BrowserRouter>
        <Routes>
          <Route path="/" element={<Home />} />

          <Route path="/account" element={<Account />} />
          <Route path="/categories" element={<Categories />} />
          <Route path="/categories/:id" element={<CategoryFood />} />
          <Route path="/foods" element={<Foods />} />
          <Route path="/foods/:id" element={<FoodDetails />} />
        </Routes>
      </BrowserRouter>
    </div>
  );
}

export default App;
