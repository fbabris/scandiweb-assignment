import { Route, Router, Routes, redirect } from 'react-router-dom';
import './App.css';
import AddProductForm from './components/addproduct/AddProductForm';
import ProductListBody from './components/index/ProductListBody';

function App() {
  return (
    <Routes>
      <Route path="/" Component={ProductListBody} />
      <Route path="/add-product" Component={AddProductForm} /> 
    </Routes>
  );
}

export default App;
