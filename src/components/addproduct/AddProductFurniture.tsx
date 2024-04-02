import React from 'react'
import { IChildrenProps } from './AddProductForm'

const AddProductFurniture: React.FC<IChildrenProps> = ({ formData, handleChange }) => {

  return (
    <>
      <div>
        <label htmlFor="height">Height:</label>
        <input
          type="number"
          id="height"
          name="height"
          value={formData.height}
          onChange={handleChange}
          required
        />
      </div>
      <div>
        <label htmlFor="width">Width:</label>
        <input
          type="number"
          id="width"
          name="width"
          value={formData.width}
          onChange={handleChange}
          required
        />
      </div>
      <div>
      <label htmlFor="length">Length:</label>
      <input
        type="number"
        id="length"
        name="length"
        value={formData.length}
        onChange={handleChange}
        required
      />
    </div>
    </>
  )
}

export default AddProductFurniture
