
const Link = () => {
  return (
    <>
        <a href="/@template" className="hover:bg-[#f5f5f7] p-[10px] rounded-[10px]">Templates</a>
        <a href={`/@terms`} className="hover:bg-[#f5f5f7] p-[10px] rounded-[10px]">Terms</a>
        <a href={`/@privacy`} className="hover:bg-[#f5f5f7] p-[10px] rounded-[10px]">Privacy</a>
    </>
  )
}

export default Link
