import React, { useEffect, useState } from 'react'
import { useFetchSpecificProduct } from '../../hooks/products/useFetchProducts';
import CustomEvents from '../../common/CustomEvents';
import { triggerCustomEvent } from '../../common/CommonUtil'
import AddToCartButton from '../atoms/AddToCartButton';
import PriceTag from '../atoms/PriceDisplay';
import VariantsList from '../atoms/VarientsList';
import { AddCartButtonType } from '../../types/Cart';
import QtyInput from '../atoms/QtyInput';
import AdditionalCost from '../atoms/AdditionalCost';

export default function ProductInfo(props) {

    const { id } = props;

    const [prodVarients, setProdVarients] = useState([])
    const [prodAdditionalCosts, setProdAdditionalCosts] = useState([])


    const [variantId, setVarientId] = useState(0);
    const [stockId, setStockId] = useState("");
    const [price, setPrice] = useState(0);
    const [isInqueryItem, setIsInqueryItem] = useState(false);
    const [qty, setQty] = useState(1);
    const [additionalCostId, setAdditionalCostId] = useState(null)
    const [unitGroupId, setUnitGroupId] = useState("");
    const [unitId, setUnitId] = useState("");


    const { data: productPriceInfo, isLoading, error } = useFetchSpecificProduct(id)




    useEffect(() => {
        if (productPriceInfo) {
            setPrice(productPriceInfo.displayPrice)
            setIsInqueryItem(productPriceInfo.isInquiryItem)
            setStockId(productPriceInfo.stockId)
            setUnitGroupId(productPriceInfo.unitGroupId)
            setUnitId(productPriceInfo.unitId)

            const variants = productPriceInfo.variants;
            setProdVarients(variants)
            setVarientId(variants[0].id)

            const additionalCosts = productPriceInfo.additionalCosts;
            setProdAdditionalCosts(additionalCosts)
        }
    }
        , [productPriceInfo])



    const onSelectedVariant = (variant) => {
        setVarientId(variant.id);
        setPrice(variant.displaySellPrice);

        setStockId(variant.stockId);

    }



    if (!!productPriceInfo) {
        return (
            <div className={"mt-2"}>
                <p className={"mb-5"}>{productPriceInfo.note}</p>
                <PriceTag price={price} size={"lg"} />
                {prodVarients.length > 1 ? <VariantsList
                    variants={prodVarients}
                    variantGroup={productPriceInfo.varientGroup}
                    onSelectedVariant={onSelectedVariant}
                    selectedVariantId={variantId}
                /> : null}


            {prodAdditionalCosts.length > 0 ? <AdditionalCost
                    values={prodAdditionalCosts}
                    onChangeValue={(v) => setAdditionalCostId(v.id)}
                    selectedValue={additionalCostId}
            />:null}

                {isInqueryItem ? <AddToCartButton
                    disabled={false}
                    productId={id}
                    stockId={stockId}
                    variantId={variantId}
                    isInqueryItem={isInqueryItem}
                    qty={qty}
                    additionalCostId={additionalCostId}
                    unitGroupId={unitGroupId}
                    unitId={unitId}
                    buttonType={AddCartButtonType.AddToCart}
                /> : <div className={"d-flex mt-4"}>

                    <div className={"pe-1"}>
                        <QtyInput
                            qty={qty}
                            onChange={(qty) => setQty(qty)}
                        />
                    </div>
                    <div className={"d-flex flex-fill ms-2"}>
                    <div className={"me-2"}>
                        <AddToCartButton
                            disabled={false}
                            productId={id}
                            stockId={stockId}
                            variantId={variantId}
                            isInqueryItem={isInqueryItem}
                            qty={qty}
                            additionalCostId={additionalCostId}
                            unitGroupId={unitGroupId}
                            unitId={unitId}
                            buttonType={AddCartButtonType.AddToCart}
                        />
                    </div>
                    <div className={"flex-fill"}>
                        <AddToCartButton
                            disabled={false}
                            productId={id}
                            stockId={stockId}
                            variantId={variantId}
                            isInqueryItem={isInqueryItem}
                            qty={qty}
                            additionalCostId={additionalCostId}
                            unitGroupId={unitGroupId}
                            unitId={unitId}
                            buttonType={AddCartButtonType.BuyNow}
                        />
                    </div>
                    </div>
                </div>}
            </div>
        )
    }
    return null
}



