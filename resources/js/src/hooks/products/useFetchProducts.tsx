import QueryKeys from "../../common/QueryKeys";
import { getAxios } from "../../common/AxiosUtil";
import {
    useQuery,
  } from 'react-query'

const api=getAxios();


type ProductPriceInfoProps={
  id:string
}
export const fetchProductPriceInfo= async ({id}:ProductPriceInfoProps) => {
    return await api.get(`/product/${id}`)
}

export const useFetchSpecificProduct = (
    productId:string,
    enabled = true
  ) => {
    return useQuery(
        [QueryKeys.PRODUCT_PRICE_INFO,productId], 
        ()=>fetchProductPriceInfo({id:productId}), {
      enabled:enabled,
      select: (data) => {
        return data.data.data
      },
    })
  }


/*====================Feature products=========================*/

export const fetchFeatureProducts= async (pageSize=10) => {
  return await api.get(`/feature-products`)
}

export const useFetchFeatureProducts = (
  pageSize,
  enabled = true,
) => {
  return useQuery(
      [QueryKeys.FEATURE_PRODUCTS,pageSize], 
      ()=>fetchFeatureProducts(pageSize), {
    enabled:enabled,
    select: (data) => {
      return data.data.data
    },
  })
}