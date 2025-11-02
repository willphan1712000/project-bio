import { useEffect } from 'react'
import FontSize from './toolComponents/FontSize'

const Tools = () => {
    /**
     * Using event delegation to track click event on element on the current template
     */
    useEffect(() => {
        console.log("Hello")
    }, [])
  return (
    <div>
        <FontSize />
    </div>
  )
}

export default Tools
