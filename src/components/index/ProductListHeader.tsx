import React, { FC, MouseEvent } from 'react';
import '../styles.css'
import { Link } from 'react-router-dom';

interface ProductListHeaderProps {
  handleSubmitClick: () => void; // Define the type of handleSubmitClick prop
}

const ProductListHeader: FC<ProductListHeaderProps> = ({ handleSubmitClick }) => {

  return (
    <div className="header">
        <div className='header_container'>
        <h2>Product List</h2>
        <div className="header_container_buttons">
            <Link to="/add-product"><button type="button" className='header_container_buttons_button'>ADD</button></Link>
            <button type="button" className='header_container_buttons_button' id='delete-product-btn' onClick={handleSubmitClick}>MASS DELETE</button>
        </div>
        </div>
        <hr className="header_hr" />
    </div>
  );
};

export default ProductListHeader;
