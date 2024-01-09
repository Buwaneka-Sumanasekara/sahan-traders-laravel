import QueryKeys from "../../common/QueryKeys";
import { getAxios } from "../../common/AxiosUtil";
import {
    useQuery,
    useMutation,
    useQueryClient,
    QueryClient,
    QueryClientProvider,
  } from 'react-query'

const api=getAxios();

export const fetchProductPriceInfo= async (id,varientId) => {
    return await api.get(`/product/${id}/${varientId}`)
}

export const useFetchSpecificProduct = (
    productId,
    varientId,
    enabled = true
  ) => {
    return useQuery(
        [QueryKeys.PRODUCT_PRICE_INFO,productId,varientId], 
        ()=>fetchProductPriceInfo(productId,varientId), {
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