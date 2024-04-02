
import { getAxios } from "../../common/AxiosUtil";


const api = getAxios();

export const createStripePaymentIntent = async (sessionId:string) => {
    return await api.post(`/action/payment/create-stripe-intent`, {sessionId})
}