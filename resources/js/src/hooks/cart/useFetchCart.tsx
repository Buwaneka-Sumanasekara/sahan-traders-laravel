import QueryKeys from "../../common/QueryKeys";
import { getAxios } from "../../common/AxiosUtil";
import {
    useQuery,
  } from 'react-query'

const api=getAxios();




export const fetchCurrentCart= async () => {
      return await api.get(`/cart/current`)
}
  
export const useFetchCurrentUserCart = (
      enabled = true
    ) => {
      return useQuery(
          [QueryKeys.CART_CURRENT], 
          ()=>fetchCurrentCart(), {
        enabled:enabled,
        select: (data) => {
          return data.data.data
        },
        onError(err) {
            console.error(err);
        },
      })
}