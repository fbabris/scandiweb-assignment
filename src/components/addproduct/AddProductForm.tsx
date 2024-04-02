import React, { useState, ChangeEvent, FormEvent, useRef } from 'react';
import AddProductHeader from './AddProductHeader';
import AddProductFurniture from './AddProductFurniture';
import AddProductBook from './AddProductBook';
import AddProductDisc from './AddProductDisc';
import { useNavigate } from 'react-router-dom';
import Notification from './Notification';

export interface FormData {
  sku: string;
  name: string;
  price: string;
  type: string;
  weight?: number|'';
  height?: number|'';
  width?: number|'';
  length?: number|'';
  size?: number|'';
}

export interface IChildrenProps {
  formData: FormData;
  handleChange: (e: React.ChangeEvent<HTMLInputElement>) => void;
}

const AddProductForm: React.FC = () => {
  const [formData, setFormData] = useState<FormData>({
    sku: '',
    name: '',
    price: '',
    type: '',
    weight: '',
    height: '',
    width: '',
    length: '',
    size: '',
  });

  const [selectedType, setSelectedType] = useState('');
  const formRef = useRef<HTMLFormElement>(null);
  const navigate = useNavigate();
  const [error, setError] = useState<string>('');

  const handleChange = (e: ChangeEvent<HTMLInputElement>|ChangeEvent<HTMLSelectElement>): void => {
    const { name, value } = e.target;
    setFormData({
      ...formData,
      [name]: value,
    });
  };

  const handleSelect = (e: ChangeEvent<HTMLSelectElement>): void => {
    setSelectedType(e.target.value);
    handleChange(e);
  }

  const handleSubmit = async (e: FormEvent<HTMLFormElement>): Promise<void> => {
    e.preventDefault();

    const trimmedArray = Object.entries(formData).filter(([_, value]) => value !== '');

    const formDataToSend = new FormData();
    for (const [key, value] of trimmedArray) {
        formDataToSend.append(key, value.toString());
    }

    try {
      const response = await fetch("http://localhost:80/scandiweb-assignment/PHP/saveController.php", {
        method: 'POST',
        mode: 'cors',
        credentials: 'include',
        body: formDataToSend
      });
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      navigate('/');
    } catch (error) {
      setError('SKU must be unique!');
    }
  }

  const handleSubmitClick = (e: React.MouseEvent<HTMLButtonElement>): void => {
    e.preventDefault();
    formRef.current && formRef.current.requestSubmit();
  };

  return (
    <div className="body">
      <AddProductHeader handleSubmitClick={handleSubmitClick} />
        <form 
          onSubmit={handleSubmit} 
          ref={formRef} 
        method="post"
        className='body_form'
        >
          <div className='body_form_sku'>
              <label htmlFor="sku">SKU:</label>
              <input
              type="text"
              id="sku"
              name="sku"
              value={formData.sku}
              onChange={handleChange}
              required
          />
          {error && <Notification message={error} />}
          </div>
          <div>
              <label htmlFor="name">Product Name:</label>
              <input
              type="text"
              id="name"
              name="name"
              value={formData.name}
              onChange={handleChange}
              required
              />
          </div>
          <div>
              <label htmlFor="price">Price ($):</label>
              <input
              type="number"
              id="price"
              name="price"
              value={formData.price}
              onChange={handleChange}
              required
              />
          </div>
          <div>
            <label htmlFor='type'>Type:</label>
            <select name="type" id="type" onChange={handleSelect} required>
              <option />
              <option value="furniture">Furniture</option>
              <option value="book">Book</option>
              <option value="dvd">DVD</option>
            </select>
          </div>

          {selectedType === "furniture" && (
            <AddProductFurniture formData={formData} handleChange={handleChange}/>
          )}
          {selectedType === "book" && (
            <AddProductBook formData={formData} handleChange={handleChange}/>
          )}
          {selectedType === "dvd" && (
            <AddProductDisc formData={formData} handleChange={handleChange}/>
          )}
        
        </form>
    </div>
  );
};


export default AddProductForm
