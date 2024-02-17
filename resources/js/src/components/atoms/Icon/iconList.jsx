import React from 'react';
import Info from './items/Info';
import Trash from './items/Trash';

export default{
    Info:(props)=><Info {...props} />,
    Trash:(props)=><Trash {...props} />
}