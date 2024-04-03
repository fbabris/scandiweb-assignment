import React, { useEffect, useRef, useState } from 'react';
import ProductListCard, { Product } from './ProductListCard';
import '../styles.css';
import ProductListHeader from './ProductListHeader';

const ProductListBody = () => {
  const [products, setProducts] = useState<Product[]>([]);
  const formsContainerRef = useRef<HTMLDivElement>(null);
  
  useEffect(() => {
    fetchProducts();
  }, []);

  const handleSubmitClick = (): void => {
    if (formsContainerRef.current) {
      const forms = formsContainerRef.current.getElementsByTagName('form');
      Array.from(forms).forEach(form => {
        form && form.requestSubmit();
      });
    }
  };

  const fetchProducts = (): void => {
    fetch('./PHP/readController.php', {
      method: 'POST',
      mode: 'cors',
      credentials: 'include'
    }).then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.json();
    }).then((data: any[]) => {
      const transformedProducts: Product[] = data.map(product => {
        let additionalInfo: string = '';
        if (product.type === 'book' && product.book_weight !== null) {
          additionalInfo = `Weight: ${product.book_weight}`;
        } else if (product.type === 'dvd' && product.dvd_size !== null) {
          additionalInfo = `Size: ${product.dvd_size}`;
        } else if (product.type === 'furniture' && product.furniture_height !== null && product.furniture_width !== null && product.furniture_length !== null) {
          additionalInfo = `Dimensions: ${product.furniture_height}x${product.furniture_width}x${product.furniture_length}`;
        }
        return {
          id: product.product_id,
          sku: product.sku,
          name: product.name,
          price: product.price,
          type: product.type,
          additionalInfo
        };
      });
  
      const sortedProducts = transformedProducts.sort((a, b) => b.id - a.id);
  
      setProducts(sortedProducts);
      
    }).catch(error => {
      console.error('Error fetching product data:', error);
    });
  };

  return (
    <div className='body' ref={formsContainerRef}>
      <ProductListHeader handleSubmitClick={handleSubmitClick} />
      {products.map((product, index) => (
        <ProductListCard key={product.id} product={product} />
      ))}
    </div>
  );
}

export default ProductListBody;