
import { getAxios } from "../../common/AxiosUtil";
import {
  useMutation,
  useQueryClient,
} from 'react-query'
import { AddressType, GeneralServerError } from "../../types/Common";
import { authenticationRedirectHandler } from "../../common/CommonUtil";

const api = getAxios();

type updateBuyerAddressProps = {
  address1: string,
  address2: string,
  city: string,
  zipCode: string,
  province: string,
  countryId: string,
  addressType:AddressType,
  updateCart?:boolean,
}
const updateBuyerAddress = async (data: updateBuyerAddressProps) => {
  console.log("data",data)
  return await api.put(`/action/buyer/address/update`, data)
}

export const useUpdateBuyerAddress = (
  onSuccessCallback?: (data: any, variables: updateBuyerAddressProps) => void,
  onErrorCallback?: (x: GeneralServerError) => void
) => {
  const queryClient = useQueryClient()
  return useMutation(updateBuyerAddress, {
    onError: (error, variables, context) => {

      const errorObj = error?.response || {};
     
       onErrorCallback?.(errorObj);

    },
    onSuccess: (data, variables) => {
      onSuccessCallback?.(data, variables)
    },
    onSettled: () => {
    },
  })
}




type updateCartItemProps = {
  id: string,
  productId: string,
  qty: number,
  unitGroupId?: string,
  unitId?: string,
}
const updateToCartItem = async (data: updateCartItemProps) => {
  return await api.put(`/action/cart/item/update`, data)
}

export const useUpdateCartItem = (
  onSuccessCallback?: (data: any, variables: updateCartItemProps) => void,
  onErrorCallback?: (x: GeneralServerError) => void
) => {
  return useMutation(updateToCartItem, {
    onError: (error, variables, context) => {

      const errorObj = error?.response || {};
      authenticationRedirectHandler({
        errorObject: errorObj,
        onErrorCallBack: onErrorCallback
      });

    },
    onSuccess: (data, variables) => {
      onSuccessCallback?.(data, variables)
    },
    onSettled: () => {
    },
  })
}




type deleteCartItemProps = {
  id: string,
  productId: string,
}
const deleteCartItem = async (data: deleteCartItemProps) => {
  return await api.post(`/action/cart/item/delete`, data)
}

export const useDeleteCartItem = (
  onSuccessCallback?: (data: any, variables: deleteCartItemProps) => void,
  onErrorCallback?: (x: GeneralServerError) => void
) => {
  return useMutation(deleteCartItem, {
    onError: (error, variables, context) => {

      const errorObj = error?.response || {};
      authenticationRedirectHandler({
        errorObject: errorObj,
        onErrorCallBack: onErrorCallback
      });

    },
    onSuccess: (data, variables) => {
      onSuccessCallback?.(data, variables)
    },
    onSettled: () => {
    },
  })
}




type updateCartCarrierProps = {
  carrierId: string,
}
const updateCartCarrier = async (data: updateCartCarrierProps) => {
  return await api.put(`/action/cart/carrier/update`, data)
}

export const useUpdateCartCarrier = (
  onSuccessCallback?: (data: any, variables: updateCartCarrierProps) => void,
  onErrorCallback?: (x: GeneralServerError) => void
) => {
  return useMutation(updateCartCarrier, {
    onError: (error, variables, context) => {

      const errorObj = error?.response || {};
      authenticationRedirectHandler({
        errorObject: errorObj,
        onErrorCallBack: onErrorCallback
      });

    },
    onSuccess: (data, variables) => {
      onSuccessCallback?.(data, variables)
    },
    onSettled: () => {
    },
  })
}