import React from 'react'
import { useFetchFeatureProducts } from '../../hooks/products/useFetchProducts';
import AddToCartButton from '../atoms/AddToCartButton';
import { AddCartButtonType } from '../../types/Cart';
import Constants from '../../common/Constants';

export default function FeatureProducts() {

    const { data: featureProducts, isLoading, error } = useFetchFeatureProducts(Constants.PAGE_SIZES.FEATURE_PRODUCT_LIST)


    const onPressProduct = (product) => {
        window.open(`/product/${product.slug}`, '_self');
    }


    const products = featureProducts || [];
    return (
        <React.Fragment>
            {products.map((product, index) => (
                <div className={"col"} key={`feature_prod${index}`}>
                    <div className="card" style={{ height: 400 }}>
                        <img src={product.mainThumbnailImageUrl}
                            className="card-img-top img-responsive"
                            style={{ width: '100%', height: 230 }} alt={product.name}
                            onClick={() => onPressProduct(product)}
                        />
                        <div className="card-body">
                            <h5 className="card-title">{product.name}</h5>
                            <p className="card-text">{product.displayPrice}</p>

                        </div>
                        <div className="card-footer d-grid">
                            <AddToCartButton
                                disabled={!product.isQtyAvailableInStock}
                                productId={product.id}
                                stockId={product.stockId}
                                variantId={product.variantId}
                                isInqueryItem={product.isInquiryItem}
                                qty={1}
                                unitGroupId={product.unitGroupId}
                                unitId={product.unitId}
                                buttonType={AddCartButtonType.AddToCart}
                            />
                        </div>
                    </div>

                </div>
            ))}
        </React.Fragment>
    )
}



