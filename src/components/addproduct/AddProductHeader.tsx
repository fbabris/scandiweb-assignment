import React from 'react'
import '../styles.css'
import { Link } from 'react-router-dom';

const AddProductHeader: React.FC<{handleSubmitClick: (e: React.MouseEvent<HTMLButtonElement>) => void}> = ({handleSubmitClick}) => {

    return (
        <div className="header">
            <div className='header_container'>
            <h2>Add Product</h2>
            <div className="header_container_buttons">
                <button type="button" className='header_container_buttons_button' onClick={handleSubmitClick}>SAVE</button>
                <Link to ="/"><button type="button" className='header_container_buttons_button' id='delete-product-btn'>CANCEL</button></Link>
            </div>
            </div>
            <hr className="header_hr" />
        </div>
      );
}

export default AddProductHeader
