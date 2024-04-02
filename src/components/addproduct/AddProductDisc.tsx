import React from 'react'
import { IChildrenProps } from './AddProductForm'

const AddProductDisc: React.FC<IChildrenProps> = ({ formData, handleChange }) => {

  return (
    <div>
      <label htmlFor="size">Size(MB):</label>
      <input
        type="number"
        id="size"
        name="size"
        value={formData.size||''}
        onChange={handleChange}
        required
      />
    </div>
  )
}

export default AddProductDisc
