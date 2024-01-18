import React from "react";
import IconObjs from './iconList'

const Icon = ({ name, ...props }) => {
    const IconTag = IconObjs[name];
    return <IconTag color={"black"} {...props} />;
}

export default Icon;