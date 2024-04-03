import React, { ChangeEvent, FormEvent, useEffect, useRef, useState } from 'react'
import '../styles.css'
import { useNavigate } from 'react-router-dom';

export interface Product {
  id: number;
  sku: string;
  name: string;
  price: number;
  type: string;
  additionalInfo: string;
}

interface ProductListCardProps {
  product: Product;
}



const ProductListCard = ({ product }:ProductListCardProps) => {
  const [isToDelete, setIsToDelete] = useState(false);
  const navigate = useNavigate(); 
  
  const handleChange = (e: ChangeEvent<HTMLInputElement>): void => {
    setIsToDelete(e.target.checked);
  };

  const handleSubmit = async (e: FormEvent<HTMLFormElement>): Promise<void> => {
    e.preventDefault();
    const formDataToSend = new FormData();
    formDataToSend.append('product_id', (product.id).toString());

    if (!isToDelete) {
      return;
    }

    try {
      const response = await fetch("./PHP/deleteController.php", {
        method: 'POST',
        mode: 'cors',
        credentials: 'include',
        body: formDataToSend,
        }); 
    } finally {
      window.location.reload();
    }
  };

  return (
    <div className='body_card'>
      <form key={product.id} onSubmit={handleSubmit}>
        <input type="checkbox" name="delete" className='delete-checkbox body_card_checkbox' onChange={handleChange} checked={isToDelete}/>
        <div className="body_card_info">
          <p className='body_card_info_sku'>SKU: {product.sku}</p>
          <p className='body_card_info_prodname'>Name: {product.name}</p>
          <p className='body_card_info_price'>Price($) {product.price}</p>
          <p className='body_card_info_param'>{product.additionalInfo}</p>
        </div>
      </form>
    </div>
  );
}
  
export default ProductListCard;
