import { ReactNode } from "react"

interface Props {
    children: ReactNode
}

/**
 * 
 * @returns App Button decorator
 */
const AppButton = ({ children }: Props) => {
  return (
    <div className="rounded-[30px] bg-[#e2e2e2] p-[10px] w-fit text-[#000]">
      {children}
    </div>
  )
}

export default AppButton
