

import { getAxios } from "../../common/AxiosUtil";
import {
  useMutation,
  useQuery,
  useQueryClient,
} from 'react-query'
import { GeneralServerError } from "../../types/Common";
import { authenticationRedirectHandler } from "../../common/CommonUtil";
import QueryKeys from "../../common/QueryKeys";

const api = getAxios();


const getPaymentInfoFromSessionId = async (sessionId:string) => {
    return await api.get(`/payment/checkout/${sessionId}`)
  }
  
  export const useFetchPaymentInfoFromSession = (
    sessionId:string,
    enabled = true
  ) => {
    return useQuery(
        [QueryKeys.PAYMENT_INFO_FROM_SESSION_ID,sessionId], 
        ()=>getPaymentInfoFromSessionId(sessionId), {
      enabled:enabled,
      select: (data) => {
        return data.data.data
      },
      onError(err) {
          console.error(err);
      },
    })
}
  