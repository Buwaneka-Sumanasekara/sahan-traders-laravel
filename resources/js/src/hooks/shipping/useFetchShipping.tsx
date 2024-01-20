import QueryKeys from "../../common/QueryKeys";
import { getAxios } from "../../common/AxiosUtil";
import {
    useQuery,
  } from 'react-query'

const api=getAxios();




export const fetchShippingCarriers= async () => {
      return await api.get(`/shipping/carriers`)
}
  
export const useFetchShippingCarriers = (
      enabled = true
    ) => {
      return useQuery(
          [QueryKeys.SHIPPING_CARRIERS], 
          ()=>fetchShippingCarriers(), {
        enabled:enabled,
        select: (data) => {
          console.log("data",data)
          return data
        },
        onError(err) {
            console.error(err);
        },
      })
}

export const fetchShippingRates= async () => {
  return await api.get(`/shipping/rates`)
}

export const useFetchShippingRates = (
  enabled = true
) => {
  return useQuery(
      [QueryKeys.SHIPPING_CARRIERS], 
      ()=>fetchShippingRates(), {
    enabled:enabled,
    select: (data) => {
      console.log("data",data)
      return data?.data || []
    },
    onError(err) {
        console.error(err);
    },
  })
}

