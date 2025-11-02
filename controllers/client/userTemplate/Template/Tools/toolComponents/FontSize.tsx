import { RangeSlider } from '@willphan1712000/frontend'
import { useState } from 'react'

const FontSize = () => {
    const [value, setValue] = useState<string>("40")
    
  return (
    <div>
      <RangeSlider 
        min="0"
        max="100"
        value={value}
        onChange={setValue}
        color='orange'
      />
    </div>
  )
}

export default FontSize
