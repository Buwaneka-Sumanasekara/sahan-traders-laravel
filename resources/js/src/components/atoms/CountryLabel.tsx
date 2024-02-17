import React from 'react';
import CountryJson from '../../common/country.json'

type CountryLabelProps={
    name:string,
    countryCode:string
}
const CountryLabel = ({ name,countryCode }:CountryLabelProps) => {

   
    const getCountryFlag = (code:string) => {
        const country= CountryJson.find(country=>{
            return (country.code===code)  
        });

        if(country){
            return country.emoji
        }
    }
  
    return (
       <span className="text-primary-emphasis">{`( ${name}`} {getCountryFlag(countryCode)} {`)`}</span>
    )
}

export default CountryLabel