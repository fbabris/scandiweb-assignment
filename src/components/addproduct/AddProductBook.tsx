import React from 'react'
import { IChildrenProps } from './AddProductForm';

const AddProductBook: React.FC<IChildrenProps> = ({ formData, handleChange }) => {

  return (
    <div>
      <label htmlFor="weight">Weight:</label>
      <input
        type="number"
        id="weight"
        name="weight"
        value={formData.weight}
        onChange={handleChange}
        required
      />
    </div>
  )
}

export default AddProductBook
