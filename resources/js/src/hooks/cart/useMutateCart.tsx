
import QueryKeys from "../../common/QueryKeys";
import { getAxios } from "../../common/AxiosUtil";
import {
    useQuery,
    useMutation,
    useQueryClient,
    QueryClient,
    QueryClientProvider,
  } from 'react-query'
import { GeneralServerError } from "../../types/Common";

const api=getAxios();

type addToCartProps={
  productId:string,
  variantId:string,
  stockId:string,
  qty:number,
  unitGroupId:string,
  unitId:string,
  additionalCostId?:string,
}
const addToCart = async (data:addToCartProps) => {
  console.log("data",data)
    return await api.post(`/action/cart/add`,data)
}
  
  export const useAddToCart = (
    onSuccessCallback?: (data: any, variables: addToCartProps) => void,
    onErrorCallback?: (x: GeneralServerError) => void
  ) => {
    const queryClient = useQueryClient()
    return useMutation(addToCart, {
      onError: (error, variables, context) => {
       
        const errorObj=error?.response;
        if(errorObj.status===401){
          window.open(`/login?redirect-to-item=${variables.productId}`,'_self');
        }else if(errorObj.status===403){
          window.open(`#`,'_self');
        }else{
          onErrorCallback?.(
            errorObj.data as GeneralServerError
          )
        }
       
      },
      onSuccess: (data, variables) => {
        onSuccessCallback?.(data,variables)
      },
      onSettled: () => {
      },
    })
  }