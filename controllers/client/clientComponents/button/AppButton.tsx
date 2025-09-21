import { ReactNode } from "react"

type Props = React.HTMLAttributes<HTMLDivElement> & {
  children: ReactNode
}

/**
 * 
 * @returns App Button decorator
 */
const AppButton = ({ children, ...props }: Props) => {
  return (
    <div
      className="flex justify-center items-center rounded-[30px] bg-[#e2e2e2] w-fit text-[#000] h-[40px] overflow-hidden"
      {...props}
    >
      {children}
    </div>
  )
}

export default AppButton
